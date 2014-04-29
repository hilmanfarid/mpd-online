<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_penerimaan_pertahunSearch" returnPage="t_rep_penerimaan_pertahun.ccp" PathID="t_rep_penerimaan_pertahunSearch" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace">
			<Components>
				<TextBox id="560" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" PathID="t_rep_penerimaan_pertahunSearchyear_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="561" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" PathID="t_rep_penerimaan_pertahunSearchvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="562" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_penerimaan_pertahunSearchp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="563" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_penerimaan_pertahunSearchp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tgl_penerimaan" PathID="t_rep_penerimaan_pertahunSearchtgl_penerimaan" format="dd-mm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="191" name="DatePicker_tgl_penerimaan" control="tgl_penerimaan" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_rep_penerimaan_pertahunSearchDatePicker_tgl_penerimaan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="564" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" PathID="t_rep_penerimaan_pertahunSearchcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="565" fieldSourceType="DBColumn" dataType="Text" name="p_account_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_penerimaan_pertahunSearchp_account_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="566" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="status_bayar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_rep_penerimaan_pertahunSearchstatus_bayar" fieldSource="status_bayar" connection="ConnSIKP" _nameOfList="Bayar" dataSource="1;Tidak Bayar;2;Bayar" _valueOfList="2">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" PathID="t_rep_penerimaan_pertahunSearchButton_DoSearch">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="567" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch1" PathID="t_rep_penerimaan_pertahunSearchButton_DoSearch1">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="568" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch2" PathID="t_rep_penerimaan_pertahunSearchButton_DoSearch2">
					<Components/>
					<Events>
					</Events>
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
		<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_rep_penerimaan_pertahun_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_rep_penerimaan_pertahun.php" forShow="True" url="t_rep_penerimaan_pertahun.php" comment="//" codePage="windows-1252"/>
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
<Action actionName="Custom Code" actionCategory="General" id="569"/>
</Actions>
</Event>
</Events>
</Page>
