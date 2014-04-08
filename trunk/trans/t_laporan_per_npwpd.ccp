<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_per_npwpd" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_per_npwpd.ccp" PathID="t_laporan_per_npwpd" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_per_npwpdButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwpd" PathID="t_laporan_per_npwpdnpwpd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="periode" fieldSource="periode" required="True" caption="Jenis Pajak" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_per_npwpdperiode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="periode1" fieldSource="periode1" required="True" caption="Jenis Pajak" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_per_npwpdperiode1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="27" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" PathID="t_laporan_per_npwpdp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="49" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id1" PathID="t_laporan_per_npwpdp_finance_period_id1" fieldSource="p_finance_period_id1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="51" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_laporan_per_npwpdButton2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_per_npwpdcetak_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="29" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="24" connection="ConnSIKP" name="HistoryGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" resultSetType="parameter" dataSource="Select c.npwd , 
	   a.t_vat_setllement_id,	
	   c.t_cust_account_id,
       c.company_name, 
       b.code as Periode_pelaporan, 
       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
       a.total_trans_amount as total_transaksi,
       a.total_vat_amount as total_pajak ,
	   a.total_penalty_amount as total_denda,
       d.receipt_no as kuitansi_pembayaran,
       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
       d.payment_amount,
       c.t_cust_account_id ,
       b.p_finance_period_id ,
       to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,
       to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan,
	   e.code as type_code
from t_vat_setllement a ,
     p_finance_period b,
     t_cust_account c,
     t_payment_receipt d,
	 p_settlement_type e
where a.p_finance_period_id = b.p_finance_period_id
      and a.t_cust_account_id = c.t_cust_account_id
	  and a.npwd = '{npwd}'
	  and b.start_date &gt;= (select start_date from p_finance_period where p_finance_period_id = {p_finance_period_id})
	  and b.end_date &lt;= (select end_date from p_finance_period where p_finance_period_id = {p_finance_period_id1})
      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
	  and a.p_settlement_type_id = e.p_settlement_type_id
order by c.npwd , b.start_date desc
">
			<Components>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_name" fieldSource="company_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridcompany_name">
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
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_awal_laporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridperiode_awal_laporan" fieldSource="periode_awal_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pelaporan" fieldSource="tgl_pelaporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtgl_pelaporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_transaksi" fieldSource="total_transaksi" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtotal_transaksi" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_pajak" fieldSource="total_pajak" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtotal_pajak" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="kuitansi_pembayaran" fieldSource="kuitansi_pembayaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridkuitansi_pembayaran">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_akhir_laporan" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridperiode_akhir_laporan" fieldSource="periode_akhir_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="38" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridt_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="39" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="customer_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridcustomer_name" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="42" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="HistoryGridt_cust_acc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" name="type_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="HistoryGridtype_code" fieldSource="type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="45" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="46" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="47" fieldName="*"/>
			</Fields>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
				<SQLParameter id="48" variable="t_cust_acc_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cust_acc_id"/>
				<SQLParameter id="50" variable="npwd" parameterType="URL" dataType="Text" parameterSource="npwpd"/>
				<SQLParameter id="52" variable="p_finance_period_id" parameterType="URL" dataType="Text" parameterSource="p_finance_period_id" defaultValue="0"/>
				<SQLParameter id="53" variable="p_finance_period_id1" parameterType="URL" dataType="Text" parameterSource="p_finance_period_id1" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_per_npwpd_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_per_npwpd.php" forShow="True" url="t_laporan_per_npwpd.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="10"/>
			</Actions>
		</Event>
	</Events>
</Page>
