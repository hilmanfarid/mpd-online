<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="12" connection="ConnSIKP" name="HistoryGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" resultSetType="parameter" dataSource="select 
	nvl(nama,company_name)as new_company_name, masa_awal, masa_akhir,data_transaksi.* 
from 
	(select 
	*
	from 
		(Select c.npwd, 
					 a.t_vat_setllement_id,	
						 c.company_name, 
						 b.code as Periode_pelaporan, 
						 to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
						 a.total_trans_amount as total_transaksi,
						 a.total_vat_amount as total_pajak ,
					 nvl(a.total_penalty_amount,0) as total_denda,
						 d.receipt_no as kuitansi_pembayaran,
						 to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
						 d.payment_amount,
						 c.t_cust_account_id ,
						 b.p_finance_period_id ,
						 to_char(a.start_period,'DD-MON-YYYY') as periode_awal_laporan,
						 to_char(a.end_period,'DD-MON-YYYY') as periode_akhir_laporan,
						 e.code as type_code,
						 nvl((case when A.debt_vat_amt &lt;= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) as debt_vat_amt,
						 nvl(a.db_increasing_charge,0) as db_increasing_charge,
						 nvl((case when A.debt_vat_amt &lt;= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) + nvl(a.db_increasing_charge,0) +nvl(a.db_interest_charge,0) + nvl(a.total_penalty_amount,0) as total_hrs_bayar,
						 nvl(a.db_increasing_charge,0) as kenaikan,
						 nvl(a.db_interest_charge,0) as kenaikan1,
						 a.p_vat_type_dtl_id,
						 a.no_kohir,
						 to_char(a.due_date,'DD-MON-YYYY') as jatuh_tempo,
						 settlement_date,
						 b.start_date
			from t_vat_setllement a,
					 p_finance_period b,
					 t_cust_account c,
					 t_payment_receipt d,
					 p_settlement_type e
			where a.p_finance_period_id = b.p_finance_period_id
						and a.t_cust_account_id = c.t_cust_account_id
					and a.t_cust_account_id = {t_cust_acc_id}
						and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
					and a.p_settlement_type_id = e.p_settlement_type_id) as hasil
	left join p_vat_type_dtl x on x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id) as data_transaksi

left join t_cust_acc_masa_jab masa_jab
	on masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id
	and masa_awal &lt;= settlement_date
	and
		case 
			when masa_akhir is NULL
				then true
			when masa_akhir &gt;= settlement_date
				then masa_akhir &gt;= settlement_date
		end

ORDER BY npwd, start_date desc, t_vat_setllement_id">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_name" fieldSource="new_company_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_pelaporan" fieldSource="periode_pelaporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridperiode_pelaporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="127" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_awal_laporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridperiode_awal_laporan" fieldSource="periode_awal_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="128" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pelaporan" fieldSource="tgl_pelaporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtgl_pelaporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="129" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_transaksi" fieldSource="total_transaksi" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtotal_transaksi" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="130" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_pajak" fieldSource="total_pajak" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtotal_pajak" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="131" fieldSourceType="DBColumn" dataType="Text" html="False" name="kuitansi_pembayaran" fieldSource="kuitansi_pembayaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridkuitansi_pembayaran">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="132" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pembayaran" fieldSource="tgl_pembayaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtgl_pembayaran">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="133" fieldSourceType="DBColumn" dataType="Float" html="False" name="payment_amount" fieldSource="payment_amount" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridpayment_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="134" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_akhir_laporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridperiode_akhir_laporan" fieldSource="periode_akhir_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="141" fieldSourceType="DBColumn" dataType="Float" name="t_vat_setllement_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridt_vat_setllement_id" fieldSource="t_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="139" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="143" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_denda" fieldSource="total_denda" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtotal_denda" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="144" fieldSourceType="DBColumn" dataType="Text" html="False" name="type_code" fieldSource="type_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtype_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="136" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridt_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="137" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="customer_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridcustomer_name" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="142" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridt_cust_acc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="145" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoPrint1" wizardCaption="Search" PathID="HistoryGridButton_DoPrint1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="147" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_vat_amt" fieldSource="debt_vat_amt" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGriddebt_vat_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="148" fieldSourceType="DBColumn" dataType="Float" html="False" name="kenaikan" fieldSource="kenaikan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridkenaikan" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="149" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_hrs_bayar" fieldSource="total_hrs_bayar" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtotal_hrs_bayar" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="150" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="151" fieldSourceType="DBColumn" dataType="Float" html="False" name="kenaikan1" fieldSource="kenaikan1" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridkenaikan1" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="152" fieldSourceType="DBColumn" dataType="Text" html="False" name="no_kohir" fieldSource="no_kohir" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridno_kohir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="153" fieldSourceType="DBColumn" dataType="Text" html="False" name="jatuh_tempo" fieldSource="jatuh_tempo" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridjatuh_tempo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="121" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="125" fieldName="*"/>
			</Fields>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
				<SQLParameter id="138" variable="t_cust_acc_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cust_acc_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_trans_histories_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_trans_histories.php" forShow="True" url="t_trans_histories.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="146"/>
			</Actions>
		</Event>
	</Events>
</Page>
