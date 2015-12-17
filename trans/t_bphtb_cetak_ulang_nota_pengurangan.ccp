<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="15" connection="ConnSIKP" name="t_bphtb_registrationGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="SELECT a.t_bphtb_registration_id, a.pilihan_lembar_cetak, b.t_customer_order_id, b.registration_no, b.wp_name, b.njop_pbb, b.wp_address_name, b.object_address_name, b.bphtb_amt_final, a.exemption_amount
FROM t_bphtb_exemption AS a 
INNER JOIN t_bphtb_registration AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id
WHERE ( upper(b.wp_name) LIKE upper('%{s_keyword}%') OR 
  upper(b.njop_pbb) LIKE upper('%{s_keyword}%') OR
  upper(b.registration_no) LIKE upper('%{s_keyword}%')
)
AND a.pilihan_lembar_cetak is not null
ORDER BY trim(b.wp_name) ASC" parameterTypeListName="ParameterTypeList">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="registration_no" fieldSource="registration_no" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registrationGridregistration_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="njop_pbb" fieldSource="njop_pbb" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registrationGridnjop_pbb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_address_name" fieldSource="wp_address_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registrationGridwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_bphtb_registration_id" fieldSource="t_bphtb_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_bphtb_registrationGridt_bphtb_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="175" fieldSourceType="DBColumn" dataType="Text" html="False" name="object_address_name" fieldSource="object_address_name" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registrationGridobject_address_name" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Float" html="False" name="bphtb_amt_final" fieldSource="bphtb_amt_final" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registrationGridbphtb_amt_final" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="306" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_name" PathID="t_bphtb_registrationGridwp_name" fieldSource="wp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="309" fieldSourceType="DBColumn" dataType="Integer" name="t_customer_order_id" PathID="t_bphtb_registrationGridt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="314" urlType="Relative" enableValidation="True" isDefault="False" name="BtnCetak" PathID="t_bphtb_registrationGridBtnCetak">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="317" urlType="Relative" enableValidation="True" isDefault="False" name="BtnCetak1" PathID="t_bphtb_registrationGridBtnCetak1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="318" urlType="Relative" enableValidation="True" isDefault="False" name="BtnCetak2" PathID="t_bphtb_registrationGridBtnCetak2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="319" urlType="Relative" enableValidation="True" isDefault="False" name="BtnCetak3" PathID="t_bphtb_registrationGridBtnCetak3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="321" urlType="Relative" enableValidation="True" isDefault="False" name="BtnCetak4" PathID="t_bphtb_registrationGridBtnCetak4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="322" fieldSourceType="DBColumn" dataType="Integer" name="pilihan_lembar_cetak" PathID="t_bphtb_registrationGridpilihan_lembar_cetak" fieldSource="pilihan_lembar_cetak">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="323" urlType="Relative" enableValidation="True" isDefault="False" name="BtnCetak5" PathID="t_bphtb_registrationGridBtnCetak5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="124" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="313" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="312" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="searchForm" returnPage="t_bphtb_cetak_ulang_nota_pengurangan.ccp" PathID="searchForm" connection="ConnSIKP" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="searchForms_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" PathID="searchFormButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_bphtb_cetak_ulang_nota_pengurangan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_bphtb_cetak_ulang_nota_pengurangan.php" forShow="True" url="t_bphtb_cetak_ulang_nota_pengurangan.php" comment="//" codePage="windows-1252"/>
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
				<Action actionName="Custom Code" actionCategory="General" id="193"/>
			</Actions>
		</Event>
	</Events>
</Page>
